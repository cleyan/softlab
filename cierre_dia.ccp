<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="10" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="TablasSearch" wizardCaption="Buscar  " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="cierre_dia.ccp" PathID="TablasSearch">
			<Components>
				<CheckBox id="14" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_optimizar" wizardCaption="Sexo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" checkedValue="1" uncheckedValue="0" visible="Yes" PathID="TablasSearchs_optimizar" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="11" urlType="Relative" enableValidation="True" isDefault="False" name="Ejecutar" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="TablasSearchEjecutar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<Grid id="3" secured="False" sourceType="SQL" returnValueType="Number" name="Tablas" wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardAllowSorting="False" wizardSortingType="Simple" wizardUsePageScroller="False" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" wizardUseTemplateBlock="False" connection="Datos" dataSource="show tables" PathID="Tablas">
			<Components>
				<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_tabla" wizardTheme="Inline" wizardThemeType="File" fieldSource="Tables_in_softlab_v2">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="8"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="reparacion" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="6"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="optimizar" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="analizar" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="16"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="sexo_id" parameterSource="s_sexo_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="nom_sexo" parameterSource="s_nom_sexo" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="cierre_dia.php" comment="//" codePage="utf-8" forShow="True" url="cierre_dia.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="cierre_dia_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="17" groupID="16"/>
		<Group id="18" groupID="17"/>
		<Group id="19" groupID="18"/>
		<Group id="20" groupID="19"/>
		<Group id="21" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="22"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
