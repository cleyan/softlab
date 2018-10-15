<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="1000" connection="Datos" name="peticiones_detalle_test" dataSource="SELECT peticion_id, codigo_fonasa, nom_test, orden_informe, coalesce(dias_demora,0) as demora,
ADDDATE(CURDATE(),INTERVAL coalesce(dias_demora,0) DAY) as entrega
FROM peticiones_detalle LEFT JOIN test ON
peticiones_detalle.test_id = test.test_id
WHERE peticiones_detalle.peticion_id = {peticion_id}
and aislado='V' and decompuesto='F'
ORDER BY orden_informe" pageSizeLimit="1000" wizardCaption="Lista de Peticiones Detalle, Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" activeCollection="SQLParameters" activeTableType="dataSource" orderBy="orden_informe" parameterTypeListName="ParameterTypeList" PathID="peticiones_detalle_test">
			<Components>
				<Sorter id="11" visible="True" name="Sorter_codigo_fonasa" column="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="codigo_fonasa" PathID="peticiones_detalle_testSorter_codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="peticiones_detalle_testSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_dias_demora" column="demora" wizardCaption="Dias Demora" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="dias_demora" PathID="peticiones_detalle_testSorter_dias_demora">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="codigo_fonasa" fieldSource="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="dias_demora" fieldSource="demora" wizardCaption="Dias Demora" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="entrega" wizardTheme="Inline" wizardThemeType="File" fieldSource="entrega" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_codigo_fonasa" fieldSource="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="Alt_dias_demora" fieldSource="demora" wizardCaption="Dias Demora" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="Alt_entrega" wizardTheme="Inline" wizardThemeType="File" fieldSource="entrega" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="25" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="peticiones_detalle_testImageLink1">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="peticion_id" orderNumber="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="peticiones_detalle" posWidth="170" posHeight="259" posLeft="10" posTop="10"/>
				<JoinTable id="5" tableName="test" posWidth="187" posHeight="416" posLeft="286" posTop="35"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="10" fieldLeft="peticiones_detalle.test_id" fieldRight="test.test_id" tableLeft="peticiones_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="4" tableName="peticiones_detalle" fieldName="peticion_id"/>
				<Field id="6" tableName="test" fieldName="codigo_fonasa"/>
				<Field id="7" tableName="test" fieldName="nom_test"/>
				<Field id="8" tableName="test" fieldName="orden_informe"/>
				<Field id="9" tableName="test" fieldName="dias_demora"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="21" variable="peticion_id" parameterType="URL" dataType="Integer" parameterSource="peticion_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="detalle_demoras.php" comment="//" codePage="utf-8" forShow="True" url="detalle_demoras.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="detalle_demoras_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="26"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
