<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" isService="False" PathID="info_test">
	<Components>
		<Grid id="2" secured="True" sourceType="SQL" returnValueType="Number" name="test" connection="Datos" dataSource="SELECT 
  test.test_id,
  test.codigo_fonasa,
  test.sub_codigo,
  test.cod_test,
  test.nom_test
FROM
  test
WHERE
 `test`.`aislado`='F'
AND
  test.test_id NOT IN (select DISTINCT test_id from `compuesto_detalle`)
  " wizardCaption="Lista de Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" PathID="info_testtest">
			<Components>
				<Sorter id="3" visible="True" name="Sorter_codigo_fonasa" column="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="codigo_fonasa" PathID="info_testtestSorter_codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="5" visible="True" name="Sorter_cod_test" column="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_test" PathID="info_testtestSorter_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="codigo_fonasa" fieldSource="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="sub_codigo" fieldSource="sub_codigo" wizardCaption="Sub Codigo" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_test" fieldSource="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="add_test.ccp" visible="Yes" PathID="info_testtestcod_test">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="25" sourceType="DataField" name="test_id" source="test_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups>
				<Group id="21" groupID="17" read="True"/>
				<Group id="22" groupID="18" read="True"/>
				<Group id="23" groupID="19" read="True"/>
				<Group id="24" groupID="20" read="True"/>
			</SecurityGroups>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<Grid id="10" secured="True" sourceType="SQL" returnValueType="Number" name="test1" connection="Datos" dataSource="SELECT
  test.test_id,
  test.codigo_fonasa,
  test.sub_codigo,
  test.cod_test,
  test.nom_test
FROM
  test
WHERE
  `test`.`compuesto`='V'
AND
  test.test_id IN (select DISTINCT test_id from `compuesto_detalle`)" wizardCaption="Lista de Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" PathID="info_testtest1">
			<Components>
				<Sorter id="11" visible="True" name="Sorter_codigo_fonasa" column="codigo_fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="codigo_fonasa" PathID="info_testtest1Sorter_codigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_sub_codigo" column="sub_codigo" wizardCaption="Sub Codigo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="sub_codigo" PathID="info_testtest1Sorter_sub_codigo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_cod_test" column="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_test" PathID="info_testtest1Sorter_cod_test">
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
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="sub_codigo" fieldSource="sub_codigo" wizardCaption="Sub Codigo" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="16" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_test" fieldSource="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="add_test.ccp" visible="Yes" PathID="info_testtest1cod_test">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="26" sourceType="DataField" name="test_id" source="test_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups>
				<Group id="17" groupID="17" read="True"/>
				<Group id="18" groupID="18" read="True"/>
				<Group id="19" groupID="19" read="True"/>
				<Group id="20" groupID="20" read="True"/>
			</SecurityGroups>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="info_test.php" comment="//" codePage="utf-8" forShow="True" url="info_test.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="info_test_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="27"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
